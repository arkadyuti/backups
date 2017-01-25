import React from 'react'

//styles
import '../../styles/layout.scss'
import '../../styles/swipe.scss';

//Fonts
import '../../fonts/font-face.scss';

//components
import Breadcrumb from '../Breadcrumb/index.js';

//containers
import DropdownContainer from '../../containers/ProjectTableContainer/drop-down.js';
import PaginationContainer from '../../containers/ProjectTableContainer/pagination.js';
import ProjectDisplayedContainer from '../../containers/ProjectTableContainer/displayed-project-container.js';
import ProjectListConatiner from '../../containers/ProjectTableContainer/index.js';

//Main component that includes all the containers required for Project List Page
export default class App extends React.Component{
	
	constructor(props) {
		super(props);
	}
	
	render(){
		return(

			<section className="project-list-header col-md-12">
				 <div className="header">
					<Breadcrumb breadcrumbProp = {[{id:"firstItem",link:"Projects"},{id:"secondItem",link:">"},{id:"lastItem",link:"Project List"}]}/>
					<div className="row sub-header">
						<h5 className="col-md-7 list-heading">PROJECT LIST</h5>
						<PaginationContainer />
						<DropdownContainer />
					</div>
				</div>
				<div className='filter-content'>
					<ProjectDisplayedContainer />
					<ProjectListConatiner />
					</div>
			</section>
		)
	}
}