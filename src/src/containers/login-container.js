import React, { PropTypes } from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

/* Importing styles */
import '../styles/login-container.scss';

/*	Importing components */
import Logo from '../components/logo';
import Title from '../components/title';
import Input from '../components/input';
import LoginButton from '../components/loginButton';

/*  Importing actions */
import * as FormActions from '../actions/form-action.js';

/* Importing reducers */
import rootReducer from '../reducers'

/* Presentational container for login form */
class LoginContainer extends React.Component {

    render() {
        const {
            validUserData,
            validPassData,
            passwordData,
            userIdData,
            errorfree,
            actions
        } = this.props;

        const propData = {
            text: 'text',
            password: 'password',
            phn: 'Sapient NT ID',
            phpw: 'Password',
            title1: 'project ',
            title2: 'Tracker',
            icon1: 'ion-person',
            icon2: 'ion-locked',
            nid: 'nt-id',
            npassword: 'nt-password',
            inputClass: 'user-id',
            passwordClass: 'password'
        };

	    return (
			<div className="login-container">
				<Logo src={"src/components/Logo/logo.png"} />
				<Title  title1={propData.title1} title2={propData.title2}/>
				<form>
    				<Input class={propData.inputClass}
        				data={propData.text}
        				ph={propData.phn}
        				icon={propData.icon1}
        				id={propData.nid}
        				validUserData = {validUserData}
        				userIdData = {userIdData}
        				actions ={actions}
        				passwordData = {passwordData}
        				validPassData = {validPassData}
                        tabIndex={2} />

    				<Input class={propData.passwordClass}
        				data={propData.password}
        				ph={propData.phpw}
        				icon={propData.icon2}
        				id={propData.npassword}
        				validPassData = {validPassData}
        				passwordData = {passwordData}
        				actions ={actions}
        				userIdData = {userIdData}
        				validUserData = {validUserData} 
                        tabIndex={3} />

    				<LoginButton errorfree={errorfree}
        				userIdData={userIdData}
        				passwordData={passwordData}
                        actions ={actions} />
                </form>
			</div>
		);
	}
}

LoginContainer.propTypes = {
    validUserData: PropTypes.bool,
    validPassData: PropTypes.bool,
    passwordData: PropTypes.string,
    userIdData: PropTypes.string,
    errorfree: PropTypes.bool.isRequired,
    actions: PropTypes.object.isRequired
};

/*
    A helper function to access the state properties
*/

function mapStateToProps(state) {
    return {
        validUserData: state.formreducer.validUserData,
        validPassData: state.formreducer.validPassData,
        passwordData: state.formreducer.passwordData,
        userIdData: state.formreducer.userIdData,
        errorfree: state.formreducer.errorfree

    };
}

/* A redux action creator */
function mapDispatchToProps(dispatch) {
    return {
        actions: bindActionCreators(FormActions, dispatch)
    };
}

/* Connects a React component to a Redux store */
export default connect(mapStateToProps, mapDispatchToProps)(LoginContainer);
