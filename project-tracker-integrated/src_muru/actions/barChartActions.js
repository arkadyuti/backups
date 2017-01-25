import axios from 'axios';

export function getInitialData(year){
  
  return function(dispatch){
    axios.get("http://localhost:3000/trends/"+year)
      .then(
        (response)=>{

          var newdata = [];
          var data1,currentYear;
          data1 = response.data;
          currentYear = data1.current;
          for(var key in data1.yearData){
            for(var key1 in data1.yearData[key])
              newdata.push(data1.yearData[key][key1]);
          }

          var data = newdata;
          var q1Data = [],q2Data=[],q3Data=[],q4Data=[],qData=[];
          var i,j;

          for(var i=0;i<data.length;i++){
            if(i<3){
              q1Data.push(data[i]);
            }
            else if(i>=3 && i<6){
              q2Data.push(data[i]);
            }
            else if(i>=6 && i<9){
              q3Data.push(data[i]);
            }
            else{
              q4Data.push(data[i]);
            }
          }
    
        qData = [q1Data,q2Data,q3Data,q4Data];

        dispatch({type:"FETCH_DATA_SUCCESS",
         payload : response.data,
        currentYear : currentYear,
        newData : newdata,
        qData : qData})
      })
      .catch((err)=>{
        dispatch({type:"FETCH_DATA_FAILURE", payload: err})
      })
      
  }
}

export function setHover(getX,getY,dValue,grpPadding,disp,monthToolTip,ttWidth,textAnchor){
  return {type : 'SET_HOVER',
               getX : getX,
               getY: getY,
               dValue: dValue,
               grpPadding : grpPadding,
               disp : disp,
               monthToolTip : monthToolTip,
               ttWidth : ttWidth,
                textAnchor : textAnchor}
}

export function setQuadrant(quadrant){
  return {type : 'SET_QUADRANT',
               activeQ : quadrant}    
}