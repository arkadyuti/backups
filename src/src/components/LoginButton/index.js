import React from 'react';
import './styles.scss';
import {browserHistory} from 'react-router';
import axios from 'axios';

export default class LoginButton extends React.Component {
	constructor(props){
		super(props);
        // Handle Function
        this.submitForm = this.submitForm.bind(this);
        this.resetStates = this.resetStates.bind(this);
        this.state={showError:false};
    }
    resetStates(){
        this.props.actions.resetState();
    }
/*
    Authentication of user on login Button, setting x-access-token and rerouting to Dashboard.
*/
    submitForm(e) {
        let buttonContext = this;
        e.preventDefault();
        axios.post('http://10.207.7.131:2220/authenticate', {
            username: this.props.userIdData,
            password: this.props.passwordData
        })
        .then(function (response) {
            if(!response.data.success){
               buttonContext.setState({showError : true});
           }
           else{
               var token = response.data.token;
               document.cookie = 'x-access-token=' + token;
               browserHistory.push('/Dashboard');
           }

       });
    }
    componentDidMount(){
      this.resetStates();
    }

    render() {
        let errorMessage = this.state.showError;
        return (
            <div className="button-container">
                <span className={errorMessage?'login-error-msg' :'login-error-msg hide'}>Please enter valid credentials</span>
                <button className={this.props.errorfree?'button-enable login-button' :'button-disable login-button'} 
                disabled={!this.props.errorfree} onClick={this.submitForm.bind(this)} tabIndex={4}> LOG IN</button>
            </div>
        );
    }

}

LoginButton.contextTypes = {
   router: React.PropTypes.object.isRequired
};


