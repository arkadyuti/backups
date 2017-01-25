import { combineReducers } from 'redux';
import counter from './counter';
import barChartReducers from './TrendsChartReducers';
import skills from './fetchDataReducer.js';
import statusChartData from './reducer_chartData.js';

const rootReducer = combineReducers({
  barChartReducers,
  skills:skills,
  statusChartData
});

export default rootReducer;
