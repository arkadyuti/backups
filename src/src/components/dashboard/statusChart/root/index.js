import React, { Component, PropTypes } from 'react';
import EachChart from '../eachChart/index'
import '../status-chart.scss';
import Loader from '../../../Loader/index';

export default class statusChart extends Component {

    constructor(props) {
        super(props);
    }

    componentWillMount() {
        this.props.fetchStatusData();
    }

    _drawEachChart(obj,i) {

        return(
            <EachChart key = {obj}
                       uniqueId={i}
                       data = {this.props.data[obj]}
                       type = {obj} />
        ) // this unique id is passed on as props to pie component
        // to give specific classname for all svg's. eg-svg0,svg1 etc
    }

    render() {
        if(!this.props.data && this.props.status === "waiting"){
            return <Loader addClass="loading">Loading...</Loader>
        } // data taking time to load

        if(this.props.status === "failed") {
            return <Loader addClass="error">Sorry! Unable to fetch data :(</Loader>
        } // if data not recieved due to ajax call.

        return (
            <div className="status-chart-svg">
                {Object.keys(this.props.data).map(::this._drawEachChart)}
            </div>
        )
    }
}