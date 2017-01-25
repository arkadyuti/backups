import React from 'react';
import { connect } from 'react-redux'
import { bindActionCreators } from 'redux'

//Styles
import './breadcrumb.scss'

//Displays the breadcrumb i..e Projects>Project-List
export default class Breadcrumb extends React.Component {
    
    assignClassname(index) {
    
        if (index == 0) {
            return 'breadcrumb-list bold-font';
        }
    
        else if (index == 1) {
            return 'breadcrumb-list';
        }
    
        else{
            return 'breadcrumb-list bold-font';
        }
    
    }
    
    render() {
    
        var breadcrumbLink = this.props.breadcrumbProp.map((breadcrumb, index) => 
            <li key={index} className={this.assignClassname(index)} id={breadcrumb.link}>
                {breadcrumb.link}
            </li>
        )
    
        return (
            <div>
                <ul className="project-list-breadcrumb">
                    {breadcrumbLink}
                </ul>
            </div>
        );
    }
}