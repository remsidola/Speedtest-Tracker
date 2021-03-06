import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Modal, Button, Tab } from 'react-bootstrap';
import Axios from 'axios';

export default class InfluxDBSettings extends Component {
    constructor(props) {
        super(props)

        this.state = {
            data: this.props.data,
        }
    }

    inputHandler = (name, val) => {
        var settings = this.state.data;
        var i = 0;
        settings.forEach(ele => {
            if(ele.obj.name == name) {
                ele.obj.value = val;
            }
            settings[i] = ele;
            i++;
        });
        this.setState({
            data: settings
        });
    }

    render() {
        var settings = this.props.generateInputs(this.state.data, this.inputHandler);

        return (
            <Tab.Content>
                <form onSubmit={(e) => { e.preventDefault() }} autoComplete="off">
                    <input type="text" autoComplete="username" style={{ display: 'none' }} />
                    <input type="password" name="password" autoComplete="passoword" style={{ display: 'none' }} />
                    {settings}
                </form>
                <div className="mt-3">
                    <button className="btn btn-primary" onClick={() => { this.props.save(this.state.data, 'healthchecks.io') }}>Save</button>
                </div>
            </Tab.Content>
        );
    }
}

if (document.getElementById('InfluxDBSettings')) {
    ReactDOM.render(<InfluxDBSettings />, document.getElementById('InfluxDBSettings'));
}
