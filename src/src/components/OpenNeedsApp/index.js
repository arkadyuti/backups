import React from 'react'

//Styles
import '../../styles/layout.scss'

//Fonts
import '../../fonts/font-face.scss'

//containers
import PaginationContainer from '../../containers/OpenNeedsContainer/pagination.js';
import ProjectListConatiner from '../../containers/OpenNeedsContainer/index.js';

//Main component that includes all the containers required for Open Needs Page
export default class OpenNeedsApp extends React.Component{
	render(){
		return(

			<section className="project-list-content col-md-12">
				 <div className="op-header">
					<div className="row sub-header">
						<h5 className="col-md-8 list-heading">OPEN NEEDS</h5>
						<PaginationContainer className="col-md-2"/>
					</div>
				</div>
				<div className='op-filter-content' id="op-filter-content">
					<ProjectListConatiner />
				</div>
			</section>

		)
	}
}