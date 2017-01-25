import React from 'react'

//styles
import '../../styles/layout.scss'

//fonts
import '../../fonts/font-face.scss';

//containers
import ProjectListConatiner from '../../containers/RedStatusContainer/index.js';

//Main component that includes all the containers required for Red Status Page
export default class RedStatusApp extends React.Component{
	render(){
		return(

			<section className="project-list-content col-md-12">
				 <div className="red-status-header">
					<div className="row sub-header">
					<h5 className="col-md-8 list-heading">RED STATUS</h5>
					</div>
				</div>
				<div className='red-filter-content' id='red-filter-content'>
					<ProjectListConatiner />
				</div>
			</section>
		)
	}
}