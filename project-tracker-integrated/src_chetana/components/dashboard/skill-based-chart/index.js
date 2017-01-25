import React from 'react';
import ReactDOM from 'react-dom';
import configureStore from '../../store/SkillBasedChartStore.js';
import {Provider} from 'react-redux'; 
import SkillBasedChartContainer from '../../containers/Dashboard/Skill-based-chart/index.js';

//stylesheets
/*
import './fonts/font-darkenstone/darkenstone.scss';

//Components
import { configureStore } from './store/configureStore';
import { Root } from './containers/Root';*/

const store = configureStore();


/*import './styles/main.scss';*/
//Render the application
ReactDOM.render(

<Provider store={store}>
  <SkillBasedChartContainer /></Provider>,
  document.getElementById('root')
);

