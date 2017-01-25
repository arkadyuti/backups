var React = require("react"),
    ptypes = React.PropTypes;

var Log = React.createClass({
    propTypes: {
        log: ptypes.arrayOf(ptypes.string).isRequired
    },
    render: function(){
        return <ul>{this.props.log.map(function(txt,n){
            return <li key={n}>{txt}</li>;
        })}</ul>;
    }
});

module.exports = Log;