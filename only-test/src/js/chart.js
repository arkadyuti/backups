
function trendsChartCallBack (response) { // function
	var newData = [];
		for(var i = 0; i< Object.values(response.yearData).length; i++ ){
			var parentValue = Object.values(response.yearData)[i];
			var childValue = Object.values(parentValue);
			newData = newData.concat(childValue);
		}
	var qData = ["Q1","Q2","Q3","Q4"];
	
	// var newData = [1110, 850, 200, 200, 400, 900, 300, 1200, 490, 100, 600, 1111];
	var len = newData.length,
	    divof3 = len/3,
	    height = 300,
	    width = 560,
	    barHeight=200,
	    barWidth=800,
	    count = 0;
	var xScale = d3.scale.ordinal()
	                    .domain(qData)
	                    .rangeBands([0,len*20+divof3*15]);
	var yScale = d3.scale.linear()
	  .domain([40,0])
	  .range([0,barHeight]);

	  var vAxis = d3.svg.axis()
	          .scale(yScale)
	          .orient("left")
	          .ticks(4); 

	  var hAxis = d3.svg.axis()
	          .scale(xScale)
	          .orient("bottom")
	          .ticks(4);

	  var tooltip = d3.select("#bar-chart")
	          .append("span")
	          .style("position","absolute");


	  var chart = d3.select("#bar-chart")
	  .append("svg")
	  .attr("height", height)
	  .attr("width", width);

	  var chart0 = chart;

	  var addAnimation = chart.append("g")
	  .selectAll( "rect" )
	  .data( newData )
	  .enter()
	  .append( "rect");

	  var chart1 = addAnimation;


	  chart1.attr( "x", function(d,i){
	    if(i%3==0){
	      count++;
	      
	    }
	    return i*20 +15*count;
	  })
	  .attr( "width", 15) 
	  .attr( "fill", function(d,i){
	    if(i%3==0){
	      return "#f26945";
	      
	    }
	    else if(i%3==1){
	      return "#1ec4c2";
	      
	    }
	    else{
	      return "#fdd04f";
	      
	    }
	  })
	  .attr( "height", 0 )
	  .attr( "y", 0 )
	  .on('mouseover',function(d){
	    tooltip.html(d)
	        .style("left", (d3.event.pageX-15) + 'px')
	        .style("top", 200-(d/10*1.5) + 'px');

	    d3.select(this)
	      .transition().duration(800)
	      .style("opacity",0.5);
	  })
	  .on('mouseout',function(d){
	    tooltip.html("");

	    d3.select(this)
	      .transition()
	      .style("opacity",1);
	    
	  })
	  .attr("transform","translate(30,10)");
	  

	  chart0.selectAll("span")
	  .data(qData)
	  .enter()
	  .append("span")
	  .text(function(d){
	    return d;
	  })
	      .style("left", function(d,i){
	        return 20*i;
	      })
	      .style("top", 180);



	  addAnimation.transition()
	        .delay(function(d,i){
	          return i*100;
	        })
	        .attr("height",function(d){
	          return d/10*1.5;
	        })
	        .attr("y",function(d){
	          return barHeight - d/10*1.5;
	        });

	  var vRuler = d3.select("svg")
	  .append("g")
	  .attr("transform","translate(30,10)");

	  var hRuler = d3.select("svg")
	  .append("g")
	  .attr("transform","translate(30,210)");

	  vAxis(vRuler);

	  hAxis(hRuler);

	  vRuler.selectAll("path")
	  .style({fill:"none"});

	  hRuler.selectAll("path")
	  .style({fill:"none"});
}