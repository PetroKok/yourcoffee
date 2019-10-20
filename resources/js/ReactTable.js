import React from 'react';
import {hydrate} from 'react-dom';
import {fetchData} from './actions/fetchData';
import ReactTable from 'react-table';
import FoldableTableHOC from 'react-table/lib/hoc/foldableTable';

import 'react-table/react-table.css';

class ReactTableComponent extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            results: undefined,
            fields: undefined,
        };
        this.mapFields = this.mapFields.bind(this);
        this.mapValues = this.mapValues.bind(this);
    }

    componentDidMount() {
        fetchData()
            .then(res => {
                const a = res.data.result.data;
                const fields = res.data.result.fields;
                const results = a.length !== 0 ? a : undefined;
                // this.setState({results: results, fields: fields}, () => {
                //     console.log(this.state)
                // })
            });
    }

    mapFields() {
        const {fields} = this.state;
        return (
            <tr>
                {fields.map((item, index) => (
                    <th key={index}>{item}</th>
                ))}
            </tr>
        );
    }

    mapValues() {
        const {results, fields} = this.state;

        return (
            <>
                {results.map((item, index) => {
                    return (
                        <tr key={index}>
                            {fields.map((field, index) => {
                                if (field === "actions") {
                                    return (
                                        <td key={index + '_'}>
                                            <a href="#" className="btn btn-info btn-circle btn-sm">
                                                <i className="fas fa-edit"></i>
                                            </a>
                                            <a href="#" className="btn btn-danger btn-circle btn-sm">
                                                <i className="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    );
                                } else {
                                    return (
                                        <td key={index + '_'}>{item[field]}</td>
                                    );
                                }
                            })}
                        </tr>
                    );
                })}
            </>
        );
    }


    render() {
        const {results, fields} = this.state;

        const data = [{
            name: 'Tanner Linsley 1',
            age: 26,
            friend: {
                name: 'Jason Maurer',
                age: 23,
            }
        },{
            name: 'Tanner Linsley 2',
            age: 26,
            friend: {
                name: 'Jason Maurer',
                age: 23,
            }
        },{
            name: 'Tanner Linsley 3',
            age: 26,
            friend: {
                name: 'Jason Maurer',
                age: 23,
            }
        },{
            name: 'Tanner Linsley 4',
            age: 26,
            friend: {
                name: 'Jason Maurer',
                age: 23,
            }
        }];

        const columns = [{
            Header: 'Name',
            foldable: true,
            accessor: 'name' // String-based value accessors!
        }, {
            Header: 'Age',
            foldable: true,
            accessor: 'age',
            Cell: props => <span className='number'>{props.value}</span> // Custom cell components!
        }, {
            id: 'friendName', // Required because our accessor is not a string
            foldable: true,
            Header: 'Friend Name',
            accessor: 'friend.name' // Custom value accessors!
        }, {
            Header: <span>Friend Age</span>, // Custom header components!
            foldable: true,
            accessor: 'friend.age'
        }]

        const FoldableTable = FoldableTableHOC(ReactTable);

        return <FoldableTable
            data={data}
            defaultPageSize={5}
            columns={columns}
        />

        if (results && fields) {
            return (
                <div>
                    <table>
                        <tbody align="right">
                        {this.mapFields()}
                        {this.mapValues()}
                        </tbody>
                    </table>
                </div>
            );
        }
        return (
            <h3>LOADING...</h3>
        );
    }
}

hydrate(<ReactTableComponent/>, document.getElementById('table'));
