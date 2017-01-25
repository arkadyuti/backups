import React from 'react';
import {connect} from 'react-redux'
import {bindActionCreators} from 'redux'

//Functions
import {calculatePagers} from '../../constants/ProjectListConstants/pagination-function.js'
//Actions
import changePerPage from '../../actions/ProjectListAction/change-per-page.js'

//Styles
import './dropdown.scss'

//To display the dropdoen for changing the number of rows displayed per page
export class Dropdown extends React.Component {
    constructor() {
        super();
    }

    //Event Listener for changing the number of rows displayed per page
    changePerPage(e) {
        var val = e.target.value
        console.log(val)
        this.props.changePerPage(val,0);
    }

    render() {
		
        return (
		    <span className="per-page-dropdown">
                <select className="per-page-list" id="pageSize" value={this.props.value}  onChange={this.changePerPage.bind(this)}>
                    {this.props.perPageValues.map((optionList, i) => <option key= {i} value={optionList}>Per page {optionList}</option>)}
                </select>
            </span>
        );
        
    }
}
Dropdown.propTypes={
    currentPage:React.PropTypes.number,
    searchedData:React.PropTypes.array,
    perPageValues:React.PropTypes.array,
    changePerPage:React.PropTypes.func
}
