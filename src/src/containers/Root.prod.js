import React, { Component } from 'react';
import { Provider } from 'react-redux';
import App from './ProjectListApp';

module.exports = class Root extends Component {
  render() {
    const { store } = this.props;
    return (
      <Provider store={store}>
        <App />
      </Provider>
    );
  }
};
