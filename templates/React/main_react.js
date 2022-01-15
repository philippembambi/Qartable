import React from 'react'
import ReactDom from 'react-dom'

var helloComponent = React.createClass({
    render: function() {
        return React.DOM.h1(null, 'Hello react')
    }
    })
ReactDom.render(React.createElement(helloComponent), document.getElementById('root'))
alert('hello')