import React from 'react';

//Actions
import handleClick from '../../actions/ProjectListAction/handle-click.js'

//Functions
import {calculateTopics,calculatePagers} from '../../constants/ProjectListConstants/pagination-function.js'

//Styles
import './project-list-pagination.scss'

export class Pagination extends React.Component {
   	
    //Click handler for page change   
    handleClick(e){
   		let page = e.target.id;
        let newCurrentPage
   		if (page == "linkPrevious") {
   			newCurrentPage = this.props.currentPage - 1
		}
		
        else if (page == "linkNext") {
			newCurrentPage = this.props.currentPage + 1
		}
		
        else if ((page == "intermediateEnd")||(page == "intermediateBeginning")){
            newCurrentPage = this.props.currentPage
        }
        
        else{
			newCurrentPage = page
		}
		newCurrentPage = parseInt(newCurrentPage)
        let topics = calculateTopics(this.props.pageSize,newCurrentPage,this.props.searchedData)
        this.props.handleClick(newCurrentPage,topics,1,newCurrentPage)
	}

    //Different class is assigned to current page and arrows
    changeBackground(value,id) {
        if (value == this.props.pageValue) {
            return 'change-background';
        }
        else if (value == '...') {
            return 'no-background';
        }
        else if (id == "linkPrevious") {
            return 'ion-arrow-left-b'
        }
        else if (id == "linkNext") {
            return 'ion-arrow-right-b'
        }
        else{
            return '';
        }
    }
    
    //Rendering of the pagination links
   	render() {
        var pagerLinks 
        if (this.props.searchedData.length) {
            pagerLinks = calculatePagers(this.props.currentPage,this.props.searchedData,this.props.pageSize)
        }
        else
        {
            pagerLinks = [{id:"currentPage", link:1},{id:"nextPage", link:2},{id: "linkNext", link: " "}];
        }
        var pageLinks = pagerLinks.map((pager, index) => 
			<li key={index} className={this.changeBackground(pager.link,pager.id)} onClick = {this.handleClick.bind(this)} id={pager.id}>
				{pager.link}
			</li>
		)
        return (
         	<span className="num-pagination">
	         	<ul className="pagination-component">{pageLinks}</ul>
			</span>
	   	);
	}
}
Pagination.propTypes={
    pagers:React.PropTypes.array,
    currentPage:React.PropTypes.number,
    searchedData:React.PropTypes.array,
    pageSize:React.PropTypes.number,
    actionPerformed:React.PropTypes.number,
    pageValue:React.PropTypes.number,
    handleClick:React.PropTypes.func
}
