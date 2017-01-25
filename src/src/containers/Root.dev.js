import React, { Component } from 'react';
import { Provider } from 'react-redux';
import DevTools from './DevTools';

module.exports = class Root extends Component {
  render() {
    const { store } = this.props;
    return (
      <Provider store={store}>
        <div>
          <DevTools />
        </div>
      </Provider>
    );
  }
};