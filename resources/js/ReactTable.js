import React, {forwardRef} from 'react';
import {hydrate} from 'react-dom';
import {fetchData, fetchDeleteData} from './actions/fetchData';
import MaterialTable from "material-table";

import AddBox from '@material-ui/icons/AddBox';
import ArrowUpward from '@material-ui/icons/ArrowUpward';
import Check from '@material-ui/icons/Check';
import ChevronLeft from '@material-ui/icons/ChevronLeft';
import ChevronRight from '@material-ui/icons/ChevronRight';
import Clear from '@material-ui/icons/Clear';
import DeleteOutline from '@material-ui/icons/DeleteOutline';
import Edit from '@material-ui/icons/Edit';
import FilterList from '@material-ui/icons/FilterList';
import FirstPage from '@material-ui/icons/FirstPage';
import LastPage from '@material-ui/icons/LastPage';
import Remove from '@material-ui/icons/Remove';
import SaveAlt from '@material-ui/icons/SaveAlt';
import Search from '@material-ui/icons/Search';
import ViewColumn from '@material-ui/icons/ViewColumn';
import Save from '@material-ui/icons/Save';
import {Loading} from "./components/Loading";
import {DeleteModal} from "./components/DeleteModal";

const tableIcons = {
    Add: forwardRef((props, ref) => <AddBox {...props} ref={ref}/>),
    Check: forwardRef((props, ref) => <Check {...props} ref={ref}/>),
    Clear: forwardRef((props, ref) => <Clear {...props} ref={ref}/>),
    Delete: forwardRef((props, ref) => <DeleteOutline {...props} ref={ref}/>),
    DetailPanel: forwardRef((props, ref) => <ChevronRight {...props} ref={ref}/>),
    Edit: forwardRef((props, ref) => <Edit {...props} ref={ref}/>),
    Export: forwardRef((props, ref) => <SaveAlt {...props} ref={ref}/>),
    Filter: forwardRef((props, ref) => <FilterList {...props} ref={ref}/>),
    FirstPage: forwardRef((props, ref) => <FirstPage {...props} ref={ref}/>),
    LastPage: forwardRef((props, ref) => <LastPage {...props} ref={ref}/>),
    NextPage: forwardRef((props, ref) => <ChevronRight {...props} ref={ref}/>),
    PreviousPage: forwardRef((props, ref) => <ChevronLeft {...props} ref={ref}/>),
    ResetSearch: forwardRef((props, ref) => <Clear {...props} ref={ref}/>),
    Search: forwardRef((props, ref) => <Search {...props} ref={ref}/>),
    SortArrow: forwardRef((props, ref) => <ArrowUpward {...props} ref={ref}/>),
    ThirdStateCheck: forwardRef((props, ref) => <Remove {...props} ref={ref}/>),
    ViewColumn: forwardRef((props, ref) => <ViewColumn {...props} ref={ref}/>),
    Save: forwardRef((props, ref) => <Save {...props} ref={ref}/>)
};

class ReactTableComponent extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            results: undefined,
            fields: undefined,
            loading: true,
            deleteModal: false
        };
        this.toggleDelete = this.toggleDelete.bind(this);
        this.onDelete = this.onDelete.bind(this);
        this.queryNewData = this.queryNewData.bind(this);
    }

    componentDidMount() {
        this.queryNewData();
    }

    queryNewData(){
        fetchData()
            .then(res => {
                const a = res.result.data;
                const fields = res.result.fields;
                const results = a.length !== 0 ? a : undefined;
                this.setState({results: results, fields: fields})
            });
    }

    async getIdForDelete(e){
        console.log(e);
        await this.setState({delete_id: e});
        await this.toggleDelete();
    }

    toggleDelete(){
        this.setState({deleteModal: !this.state.deleteModal});
    }

    onDelete(){
        const {delete_id} = this.state;
        let results = this.state.results;
        this.toggleDelete();
        fetchDeleteData(delete_id)
            .then(res => {
                let removed = _.remove(this.state.results, function(res) {
                    return res.id !== delete_id;
                });
                this.setState({results: removed})
            });
    }

    render() {
        const {results, fields, loading} = this.state;

        if (results && fields && loading) {
            return (
                <>
                    {this.state.deleteModal && (
                        <DeleteModal onClose={ () => this.toggleDelete} onDelete={() => this.onDelete}/>
                    )}
                    <MaterialTable
                        actions={[
                            {
                                icon: tableIcons.Add,
                                tooltip: 'Add User',
                                isFreeAction: true,
                                onClick: (event) => alert("You want to add a new row")
                            },
                            {
                                icon: tableIcons.Edit,
                                tooltip: 'Edit User',
                                onClick: (event, rowData) => {
                                    // Do save operation
                                }
                            },
                            {
                                icon: tableIcons.Delete,
                                tooltip: 'Delete User',
                                onClick: (event, rowData) => this.getIdForDelete(rowData.id)
                            }
                        ]}
                        icons={tableIcons}
                        columns={fields}
                        data={results}
                        title="Table"
                        options={{
                            actionsColumnIndex: -1
                        }}
                    />
                </>
            );
        }

        return (
            <Loading/>
        );
    }
}

hydrate(<ReactTableComponent/>, document.getElementById('table'));
