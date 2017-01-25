import axios from 'axios';
import {URL_TRENDS_CHART} from '../../../constants/Dashboard/url/index.js';

export function getInitialData(year){
  
  return function(dispatch){
    axios.get(URL_TRENDS_CHART)
      .then(
        (response)=>{

          let responseData = [];
          let data1,currentYear,leastYear;
           let indexes = response.data.trends.map(function(obj, index) {
                if(obj.id== year) {
                    return index;
                }
            }).filter(isFinite);
            data1 = response.data.trends[indexes[0]];
           //data1 = response.data;
          currentYear = data1.current;
          leastYear = data1.least_year;
          for(let key in data1.yearData){
            for(let key1 in data1.yearData[key])
                responseData.push(data1.yearData[key][key1]);
          }

          let data2 = responseData;
          let quarter1Data = [],quarter2Data=[],quarter3Data=[],quarter4Data=[],quarterData=[];

          for(let i=0;i<data2.length;i++){
            if(i<3){
              quarter1Data.push(data2[i]);
            }
            else if(i>=3 && i<6){
              quarter2Data.push(data2[i]);
            }
            else if(i>=6 && i<9){
              quarter3Data.push(data2[i]);
            }
            else{
              quarter4Data.push(data2[i]);
            }
          }

        quarterData = [quarter1Data,quarter2Data,quarter3Data,quarter4Data];

        dispatch({type:"FETCH_DATA_SUCCESS",
        currentYear : currentYear,
        leastYear : leastYear,
        responseData : responseData,
        quarterData : quarterData})
      })
      .catch((err)=>{
        console.log("error ",err);
        dispatch({type:"FETCH_DATA_FAILURE", err: err})
      })
      
  }
}

export function setHover(getX,getY,tooltipValue,groupPadding,tooltipDisplay,monthToolTip,tooltipWidth,textAnchor){
  return {type : 'SET_HOVER',
                getX : getX,
                getY: getY,
                tooltipValue: tooltipValue,
                groupPadding : groupPadding,
                tooltipDisplay : tooltipDisplay,
                monthToolTip : monthToolTip,
                tooltipWidth : tooltipWidth,
                textAnchor : textAnchor}
}

export function setQuarter(quarter){
  return {type : 'SET_QUARTER',
      activeQuarter : quarter}
}