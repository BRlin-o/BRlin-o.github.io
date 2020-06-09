function App(){
	var row = []
    for (var i=0;i<3;++i){
        var col = []
        for (var j=1;j<=3;++j){
            var list = []
            for (var k=1;k<=9;++k){
				var one = i*3+j;
				var two = one*k;
				var myString = one.toString() + " * " + k.toString() + " = ";
				if((two/10)>=1){
					list.push(<span>{myString}{two}<br/></span>)
				}else{
					list.push(<span>{myString}&nbsp;&nbsp;{two}<br/></span>)
				}
            }
            col.push(<td>{list}</td>)
        }
        row.push(<tr>{col}</tr>)
    }
    return (
		<div className="">
			<div className="col text-center spacialTitle">
				九九乘法表	
			</div>
			<div className="w-100"></div>
			<div>
				<table className="table table-bordered text-center">
					<tbody>
						{row}
					</tbody>
				</table>
			</div>
		</div>
    )
}
ReactDOM.render(
	<App />,
    document.getElementById('example')
);
