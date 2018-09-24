
var width = 960,
    height = 600,
    centered;

// Define color scale
var color = d3.scale.linear()
  .domain([1, 47])
  .clamp(true)
  .range(['#fff', '#409A99']);

var projection = d3.geo.mercator()
  .scale(2800)
  .center([37, 0])
  .translate([width / 2, height / 2]);

  console.log(projection)

var path = d3.geo.path()
  .projection(projection);

// Set svg width & height
var svg = d3.select('#container_svg')
  .attr('width', width)
  .attr('height', height);

// Add background
svg.append('rect')
  .attr('class', 'background')
  .attr('width', width)
  .attr('height', height)
  .style("fill", "white")
  .on('click', clicked);

var g = svg.append('g');

var effectLayer = g.append('g')
  .classed('effect-layer', true);

var mapLayer = g.append('g')
  .classed('map-layer', true);

var dummyText = g.append('text')
  .classed('dummy-text', true)
  .attr('x', 10)
  .attr('y', 30)
  .style('opacity', 0);

var countyText = g.append('text')
  .classed('display-1', true)
  .attr('x', 20)
  .attr('y', 45);

 //Fetch Ke geoJson
  var jsonUrl = 'https://data.humdata.org/dataset/e66dbc70-17fe-4230-b9d6-855d192fc05c/resource/51939d78-35aa-4591-9831-11e61e555130/download/kenya.geojson';  
  
  
// Load map data
d3.json(jsonUrl).then(function(mapData) {
  var features = mapData.features;
    console.log(features)
  // Update color scale domain based on data
  color.domain([0, d3.max(features, nameLength)]);

  // Draw each county as a path
  mapLayer.selectAll('path')
      .data(features)
    .enter().append('path')
      .attr('d', path)
      .attr('vector-effect', 'non-scaling-stroke')
      .style('fill', fillFn)
      .on('mouseover', mouseover)
      .on('mouseout', mouseout)
      .on('mousemove', )
      .on('click', function(d){clicked(d)});
});

// Get province name
function nameFn(d){
  return d && d.properties ? d.properties.COUNTY_NAM : null;
}

// Get county code
function countyCodeFn(d){
 return d&& d.properties ? d.properties.COUNTY_COD:null;
}


// Get county name length
function nameLength(d){
  var n = nameFn(d);
  return n ? n.length : 0;
}

// Get county color
function fillFn(d){
  return color(nameLength(d));
}

// When clicked, zoom in
function clicked(d) {
  var x, y, k;

  // Compute centroid of the selected path
  if (d && centered !== d) {
    var centroid = path.centroid(d);
    x = centroid[0];
    y = centroid[1];
    k = 4;
    centered = d;
  } else {
    x = width / 2;
    y = height / 2;
    k = 1;
    centered = null;
  }

  // Highlight the clicked province
  mapLayer.selectAll('path')
    .style('fill', function(d){return centered && d===centered ? '#D5708B' : fillFn(d);});

  // Zoom
  g.transition()
    .duration(750)
    .attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')scale(' + k + ')translate(' + -x + ',' + -y + ')');
}

function mouseover(d){
  // Highlight hovered county
  d3.select(this).style('fill', 'orange');

  // Draw effects
  //nameCounty(nameFn(d));
  mouseOverPopup(nameFn(d));
}

function nameCounty(text){
    countyText.style("font-weight", 'bolder').text(text);
}

function mouseOverPopup(name){

    console.log('dfdfd');
    //Fetch facility count and show tooltip
    axios.get('/home/get_facilities_drilldown/'+name).then(function(response){
        console.log(response.data);
        console.log('sdfsdfsdfsdf');
    })
}

function mouseout(d){
  // Reset county color
  mapLayer.selectAll('path')
    .style('fill', function(d){return centered && d===centered ? '#D5708B' : fillFn(d);});

  // Remove effect text
  effectLayer.selectAll('text').transition()
    .style('opacity', 0)
    .remove();

  // Clear province name
  countyText.text('');
}

