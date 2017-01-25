import React from 'react';
import './styles.scss'

export default (props) => {
        return (
            <div className = "loader-div">
            <h1 className={`loader ${props.addClass}`}>{props.children}</h1>
            </div>
        )

}