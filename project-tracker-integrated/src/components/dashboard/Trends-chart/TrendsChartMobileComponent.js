import React from 'react';
import * as d3 from 'd3';

import BarsMobileComponent from '../../../containers/BarsMobileContainer.js';
import LegendMobileComponent from '../../../containers/LegendMobileContainer.js';
import YAxisMobileComponent from '../../../containers/YAxisMobileContainer.js';



class TrendsChartMobileComponent extends React.Component {

    constructor(props){
        super(props);
        this.prevYearData = ::this.prevYearData;
        this.nextYearData = ::this.nextYearData;
        this.prevQuadrantData = ::this.prevQuadrantData;
        this.nextQuadrantData = ::this.nextQuadrantData;
    }

    componentDidMount() {
        let year = new Date().getFullYear();
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
        let year = (this.props.currentYear) - 1;

        this.props.getInitialData(year);

    }

    nextYearData(e){
        e.preventDefault();
        let year = (this.props.currentYear) + 1;

        this.props.getInitialData(year);
    }

    prevQuadrantData(e){
        e.preventDefault();
        let prevQ = (parseInt(this.props.activeQ)-1).toString();
        this.props.setQuadrant(prevQ);
    }

    nextQuadrantData(e){
        e.preventDefault();
        let nextQ = (parseInt(this.props.activeQ)+1).toString();
        this.props.setQuadrant(nextQ);
    }

    render() {

        if((this.props.qData.length===0 || this.props.qData[0].length===0) && (this.props.fetching)==false){
            return <h2 className="loader error">Sorry! Unable to fetch data :(</h2>
        }

        if(this.props.qData.length===0 || this.props.qData[0].length===0){
            return <h1 className="loader loading">Loading...</h1>
        }


        let prevBtnDisplay = {
            visibility : (this.props.currentYear>2014)?"visible":"hidden"
        };
        let nextBtnDisplay = {
            visibility : (this.props.currentYear<2016)?"visible":"hidden"
        };
        let prevQBtnDisplay = {
            visibility : (this.props.activeQ=='1')?"hidden":"visible",
            marginRight : 70
        };
        let nextQBtnDisplay = {
            visibility : (this.props.activeQ=='4')?"hidden":"visible",
            marginLeft : 70
        };
        return (
            <div id="bar-chart" className="bar-chart">
                <div className="upper-display-chart">
                    <input type="button" style = {prevBtnDisplay} className="year-btn btn" value="<" onClick={this.prevYearData} />
                    <span className="year-display">{this.props.currentYear}</span>
                    <input type="button" style = {nextBtnDisplay} className="year-btn btn" value=">" onClick={this.nextYearData} />

                </div>
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
                    <span className="year-display">{`Q${this.props.activeQ}`}</span>
                    <input type="button" style = {nextQBtnDisplay} className="year-btn btn" value=">" onClick={this.nextQuadrantData} />

                </div>
            </div>
        );

    }
}

export default TrendsChartMobileComponent;
