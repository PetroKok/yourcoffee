import React from 'react';
import {hydrate} from 'react-dom';
import {fetchData} from './actions/fetchData'

class ReactTable extends React.Component {

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
                this.setState({results: results, fields: fields}, () => {
                    console.log(this.state)
                })
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

hydrate(<ReactTable/>, document.getElementById('table'));
