var React = require('react'),
    ReactDOM = require('react-dom'),
    Router = require('react-router').Router,
    Provider = require('react-redux').Provider,
    store = require('./store'),
    routes = require('./routes');

ReactDOM.render(
    // The top-level Provider is what allows us to `connect` components to the store
    // using ReactRedux.connect (see components Home and Hero)
    <Provider store={store}>
        <Router routes={routes}/>
    </Provider>,
    document.getElementById("root")
);