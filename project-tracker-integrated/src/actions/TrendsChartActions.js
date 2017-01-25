import axios from 'axios';

export function getInitialData(year){
  
  return function(dispatch){
    axios.get("http://localhost:3000/trends/"+year)
      .then(
        (response)=>{

          let newdata = [];
          let data1,currentYear;
          data1 = response.data;
          currentYear = data1.current;
          for(let key in data1.yearData){
            for(let key1 in data1.yearData[key])
              newdata.push(data1.yearData[key][key1]);
          }

          let data = newdata;
          let q1Data = [],q2Data=[],q3Data=[],q4Data=[],qData=[];
          let i,j;

          for(let i=0;i<data.length;i++){
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