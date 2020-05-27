var React = require('react');

let Nine = React.createClass({
	Each(){
		let row = []
		for (let i=1; i<=3; ++i){
			let col = []
			for (let j=1;j<=3;++j){
				let list = []
				for (let k=1;k<=9;++k){
					list.push(<span>{j}*{k}={j*k}<br/></span>)
				}
				col.push(<td>{list}</td>)
			}
			row.push(<tr>{col}</tr>)
		}
		return row
	},
	render(){
		return(
			<tbody>{this.Each()}</tbody>
		)
	}
})
ReactDOM.render(
  <Nine/>,
  document.getElementById('example')
);
