import React from 'react';
import * as d3 from 'd3';

import BarsMobileComponent from '../../../containers/Dashboard/TrendsChart/bars-mobile.js';
import LegendMobileComponent from '../../../containers/Dashboard/TrendsChart/legend-mobile.js';
import YAxisMobileComponent from '../../../containers/Dashboard/TrendsChart/y-axis-mobile.js';
import Loader from '../../Loader/index.js';


class TrendsChartMobileComponent extends React.Component {

    constructor(props){
        super(props);
        this.prevYearData = ::this.prevYearData;
        this.nextYearData = ::this.nextYearData;
        this.prevQuadrantData = ::this.prevQuadrantData;
        this.nextQuadrantData = ::this.nextQuadrantData;
        this.state={
            currentYear : 0
        }
    }

    componentDidMount() {
        let year = new Date().getFullYear();
        this.setState({currentYear:year});
        //make the axios call
        this.props.getInitialData(year);
    }

    componentWillUpdate(){
        d3.selectAll("#bars rect")
            .attr("width", 0);
    }
    componentDidUpdate(){
        d3.selectAll("#bars rect")
            .transition()
            .duration(1000)
            .attr("width", 40);
    }

    prevYearData(e){
        e.preventDefault();
        let year = (this.state.currentYear) - 1;
        this.setState({currentYear:year});
        this.props.getInitialData(year);

    }

    nextYearData(e){
        e.preventDefault();
        let year = (this.state.currentYear) + 1;
        this.setState({currentYear:year});
        this.props.getInitialData(year);
    }

    prevQuadrantData(e){
        e.preventDefault();
        let prevQuarter = (parseInt(this.props.activeQuarter)-1).toString();
        this.props.setQuarter(prevQuarter);
    }

    nextQuadrantData(e){
        e.preventDefault();
        let nextQuarter = (parseInt(this.props.activeQuarter)+1).toString();
        this.props.setQuarter(nextQuarter);
    }

    render() {

        if((this.props.quarterData.length===0 || this.props.quarterData[0].length===0) && this.props.error!=null && this.props.fetching==false){
            return <Loader addClass="error">Sorry! Unable to fetch data :(</Loader>
        }

        if(this.props.quarterData.length===0 || this.props.quarterData[0].length===0){
            return <Loader>Loading...</Loader>
        }


        let prevBtnDisplay = {
            visibility : (this.state.currentYear>this.props.leastYear)?"visible":"hidden"
        };
        let nextBtnDisplay = {
            visibility : (this.state.currentYear<2016)?"visible":"hidden"
        };
        let prevQBtnDisplay = {
            visibility : (this.props.activeQuarter=='1')?"hidden":"visible",
            marginRight : 70
        };
        let nextQBtnDisplay = {
            visibility : (this.props.activeQuarter=='4')?"hidden":"visible",
            marginLeft : 70
        };
        const dataDisplay =
            <div>
                    <div className="legend-wrapper">
                        <LegendMobileComponent />
                    </div>
                    <div className = "svg-wrapper">
                        <svg height="100%" width="100%" viewBox="0 0 564 314" preserveAspectRatio="none" >
                            <BarsMobileComponent />
                            <YAxisMobileComponent />
                        </svg>
                    </div>
                    <div className="quadrant-display-chart">
                        <input type="button" style = {prevQBtnDisplay} className="year-btn btn" value="<" onClick={this.prevQuadrantData} />
                        <span className="year-display">{`Q${this.props.activeQuarter}`}</span>
                        <input type="button" style = {nextQBtnDisplay} className="year-btn btn" value=">" onClick={this.nextQuadrantData} />
                    </div>
            </div>;

        const errorDisplay = <Loader addClass="error">Sorry! Unable to fetch data :(</Loader>;

        const successOrFailure = (this.props.error!=null && this.props.fetching==false)? errorDisplay :dataDisplay;

        return (
            <div id="bar-chart" className="bar-chart">
                <div className="upper-display-chart">
                    <input type="button" style = {prevBtnDisplay} className="year-btn btn" value="<" onClick={this.prevYearData} />
                    <span className="year-display">{this.state.currentYear}</span>
                    <input type="button" style = {nextBtnDisplay} className="year-btn btn" value=">" onClick={this.nextYearData} />

                </div>

                {successOrFailure}

            </div>
        );

    }
}

export default TrendsChartMobileComponent;
