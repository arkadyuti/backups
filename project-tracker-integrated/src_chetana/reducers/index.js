import { combineReducers } from 'redux';
import counter from './counter';
import barChartReducers from './barChart';
import skills from './Dashboard/Skill-based-chart/skillBasedChartReducer.js';
import statusChartData from './reducer_chartData.js';
import legendOrdinate from './reducer_legend';

const rootReducer = combineReducers({
  barChartReducers,
  skills:skills,
  statusChartData,
  legendOrdinate
});

export default rootReducer;
