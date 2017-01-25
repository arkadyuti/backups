import { combineReducers } from 'redux';
import counter from './counter';
import barChartReducers from './barChart';
import skills from './fetchDataReducer.js';
import statusChartData from './Dashboard/Status-chart/reducer_statusChartData.js';
import statusChartInnerRadius from './Dashboard/Status-chart/reducer_statusChartInnerRadius.js'
import statusChartOuterRadius from './Dashboard/Status-chart/reducer_statusChartOuterRadius.js'

const rootReducer = combineReducers({
  barChartReducers,
  skills:skills,
  statusChartData,
  statusChartInnerRadius,
  statusChartOuterRadius
});

export default rootReducer;
