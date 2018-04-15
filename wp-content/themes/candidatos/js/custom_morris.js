jQuery(document).ready(function( $ ) {

	

 Morris.Bar({
    element: 'myfirstchart',
    data: [{
      x: 'Consulta Mitofsky',
      y: 29.5,
      z: 21.2,
      a: 16.4,
      b: 4.8,
      c: 28
    }, {
      x: 'GEA-ISA',
      y: 27,
      z: 23,
      a: 20,
      b: 1,
      c: 28
    }, {
      x: 'SDP Noticias',
      y: 39.5,
      z: 19.5,
      a: 24.3,
      b: 8,
      c: 4.5
    }, {
      x: 'Parametría',
      y: 35,
      z: 21,
      a: 16,
      b: 10,
      c: 12
    }],
    xkey: 'x',
    ykeys: ['y', 'z', 'a', 'b','c'],
    labels: ['Andres Manuel', 'Ricardo Anaya', 'José Meade', 'Margarita Zavala','No sabe']
  });


 Morris.Line({
  element: 'linechart',
  data: [
    { y: '2018-04-01', a: 0, b: 0,c:0,d:0,e:0 },
    { y: '2018-04-08', a: 57, b: 11,c:23,d:7,e:2 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b','c','d','e'],
 labels: ['Andres Manuel', 'Ricardo Anaya', 'José Meade', 'Margarita Zavala','No sabe']
});

 
});