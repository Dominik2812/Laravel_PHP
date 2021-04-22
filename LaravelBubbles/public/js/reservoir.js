

function getData() {
    return JSON.parse(myArr);
}
datasets = getData();


///One dataset is one bubble
for(dataset of datasets){

////////////scale and Color
    var width = 300,
    height = 300,
    radius = Math.min(width / 2, height / 2) * 0.90;
    var divHeight = height;
    var divWidth = width;

    var x = d3.scale.linear()
    .range([0, 2 * Math.PI]);

    var y = d3.scale.linear()
    .range([0, radius]);

    var colorScheme = ["#E57373","#BA68C8","#7986CB","#A1887F","#90A4AE","#AED581","#9575CD","#FF8A65","#4DB6AC","#FFF176","#64B5F6","#00E676"];
    var color = d3.scale.ordinal().range(colorScheme); 


//////////Create elements
    var tooltip = d3.select("body")
    .append("div")
    .attr("id", "chart")
    .style(style="margin-left:80px;" )


    var svg = d3.select("#chart").append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", "translate(" + divWidth / 2 + "," + height / 2 + ") rotate(-90 0 0)");





/////////Kind-childrenHirarchi
    var partition = d3.layout.partition()
    .value(function(d) {
        // if (d.depth!=0)
        console.log('partition')
        console.log(d)
        console.log(d.depth)
        return d.size;
    });

    //var partition = d3.layout
    // .value(function(d) {
    //     console.log('partition')
    //     console.log(d.depth)
    //     return d.size;
    // });

    //touch and display
    var tooltip = d3.select("body")
    .append("div")
    .attr("class", "tooltip")
    .style("position", "absolute")
    .style("z-index", "10")
    .style("opacity", 0);

    var arc = d3.svg.arc()
    .startAngle(function(d) {
        if (d.size != 0)
            return Math.max(0, Math.min(2 * Math.PI, x(d.x)));
    })
    .endAngle(function(d) {

        if (d.depth == 0){
            return Math.max(0, Math.min(2 * Math.PI, x(d.x + d.dx)))};

        if (d.depth == 2) {
            return Math.max(0, Math.min(2 * Math.PI, x(d.x + d.dx)));
        }

        if (d.size != 0){
            return Math.max(0, Math.min(2 * Math.PI, x(d.x + d.dx)))};
    })
    .innerRadius(function(d) {
        if (d.size != 0)
            return Math.max(0, y(d.y));
    })
    .outerRadius(function(d) {
        if (d.size != 0)
            return Math.max(0, y(d.y + d.dy));

    });

//// Create d3 Elements and Eventhandler
    var root = dataset;
    console.log('root')
    console.log(root)
    console.log(root.size)
    console.log(root.depth)
    
    svg.attr('id',"g_" + root.id)

    var g = svg.selectAll("g")
    .data(partition.nodes(root))
    .enter().append("g");
 
    // function getRootmostAncestorByRecursion(node) {
    //     return node.depth > 1 ? getRootmostAncestorByRecursion(node.parent) : node;
    // }

    //path is the shape of the svg
    var path = g.append("path")
    .attr("d", arc)
    .style('fill', function (d) { 
        if (d.depth==0){
        return color(d.color);
        }
        if (d.depth!=0){
            return color((d.children ? d : d.parent).name);
        }
    })

    // .style("fill", function(d) {
    //     return color((d.children ? d : d.parent).name);
    // })
    .on("click", click)
    .on("mouseover", function(d) {
        tooltip.html(function() {
            return d.name /* + "<br>" + d.value; */
        });
        return tooltip.transition()
        .duration(50)
        .style("opacity", 0.9);
    })
    .on("mousemove", function(d) {
        return tooltip
        .style("top", (d3.event.pageY-10)+"px")
        .style("left", (d3.event.pageX+10)+"px");
    })
    .on("mouseout", function(){return tooltip.style("opacity", 0);});


    var text = g.append("text")
    .attr("x", function(d) {
        return y(d.y);
    })
    .attr("dx", function(d) {
        return d.depth == 0 ? "9" : "9"
        }) // margin
    .attr("dy", ".35em") // vertical-align
    .attr('id', function(d){return "text"+d.id})
    .attr("transform", function(d) {
         return "rotate(" + computeTextRotation(d) + ")";
        })
    .text(function(d) {
            return d.size == null ? d.name : d.name.substring(0,5); ;
        })
    .style("fill", "black")
    .style("font-size", "12px");

    function computeTextRotation(d) {
        // var angle = x(d.x + d.dx / 2) - Math.PI / 2;
        var angle = x(d.x + d.dx / 2) - Math.PI / 2;
        return angle / Math.PI * 180;
    }

    // Word wrap!
    var insertLinebreaks = function(t, d, width) {
        var el = d3.select(t);
        var p = d3.select(t.parentNode);

        p.append("g")
        .attr("x", function(d) {
            return y(d.y);
        })
            .attr("dx", "6") // margin
            .attr("dy", ".35em") // vertical-align
            .attr("transform", function(d) {
                return "rotate(" + computeTextRotation(d) + ")";
            })

            .append("foreignObject")
            .attr('x', -width / 2)
            .attr("width", width)
            .attr("height", 200)
            .append("xhtml:p")
            .attr('style', 'word-wrap: break-word; text-align:center;')
            .html('d.name');
            el.remove();
        };

        d3.select(self.frameElement).style("height", height + "px");

    //Drag and Drop Event (Step1)
    g.on("mousedown", function () {

        console.log(this.children[1].id)
        console.log(String(this.children[1].id).slice(4))
        g_Id=String(this.children[1].id).slice(4);//this.textContent;
        });
}



var text = d3.selectAll("text")
var path = d3.selectAll("path")

function click(d) {

    console.log(d.name)

    for(txt of text[0]){
        if (txt.parentNode.parentNode == this.parentNode.parentNode){
            // console.log('schkleigfe')
            // console.log(txt)
            // console.log(d3.select("#"+this.parentNode.parentNode.id))
        }
    }

    Hülle=d3.select("#"+this.parentNode.parentNode.id)
    text = Hülle.selectAll("text")
    path = Hülle.selectAll("path")


    if (d.size !== undefined) {
        console.log(d)
        d.size += 100;
    };
    text.transition().attr("opacity", 0);


    path.transition()
    .duration(500)
    .attrTween("d", arcTween(d))
    .each("end", function(e, i) {
            // check if the animated element's data e lies within the visible angle span given in d
            if (e.x >= d.x && e.x < (d.x + d.dx)) {

                // get a selection of the associated text element
                var arcText = d3.select(this.parentNode).select("text");

                // fade in the text element and recalculate positions
                arcText.transition().duration(750)
                .attr("opacity", 1)
                .attr("transform", function() {
                    return "rotate(" + computeTextRotation(e) + ")"
                })
                .attr("x", function(d) {
                    return y(d.y);
                });
            }
        });
    } ;

// Interpolate the scales!
function arcTween(d) {
    var xd = d3.interpolate(x.domain(), [d.x, d.x + d.dx]),
    yd = d3.interpolate(y.domain(), [d.y, 1]),
    yr = d3.interpolate(y.range(), [d.y ? 20 : 0, radius]);
    return function(d, i) {
        return i ? function(t) {
            return arc(d);
        } : function(t) {
            x.domain(xd(t));
            y.domain(yd(t)).range(yr(t));
            return arc(d);
        };
    };
}



