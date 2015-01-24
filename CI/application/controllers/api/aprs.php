<?php

require(APPPATH.'libraries/REST_Controller.php');

class aprs extends REST_Controller {
	
    public function aprsfi_get() {
      $aprsJSON = file_get_contents('http://api.aprs.fi/api/get?apikey=26489.3iU1y0vyFxsCVhIb&name=LA6TRA-8,LA4GY-2,LA7MR,LA7ECA-3,LD8MR-B,IRLP5919,ENRA&what=loc&format=json');
      $arr = json_decode($aprsJSON, true);
		  $this->response($arr);
    }

    public function aprsfiStatic_get() {
      $aprsJSON = '{"command":"get","result":"ok","what":"loc","found":7,"entries":[{"class":"a","name":"LA6TRA-8","type":"l","time":"1421994182","lasttime":"1421994185","lat":"66.30650","lng":"14.12850","symbol":"\/>","srccall":"LA6TRA-8","dstcall":"APOT21","comment":"14.2V idle","status":"14.7V idle","status_lasttime":"1421993865","path":"WIDE2-1,qAR,LA4GY-2"},{"class":"a","name":"LA4GY-2","type":"l","time":"1211829339","lasttime":"1422021994","lat":"66.30500","lng":"13.95250","symbol":"T&","srccall":"LA4GY-2","dstcall":"APU25N","phg":"5350","comment":"Mo i Rana - iGate - TX\/RX {UIV32N}","path":"TCPIP*,qAC,T2KRAKOW"},{"class":"a","name":"LA7MR","type":"o","time":"1375375116","lasttime":"1422023193","lat":"66.20683","lng":"13.74050","symbol":"\/r","srccall":"LA1PHA-2","dstcall":"APRX28","comment":"145.675MHz T088 -060 R75k LA7MR Repeater","path":"TCPIP*,qAC,T2RADOM"},{"class":"a","name":"LA7ECA-3","type":"l","time":"1414620004","lasttime":"1422023464","lat":"66.31733","lng":"14.15917","symbol":"\/-","srccall":"LA7ECA-3","dstcall":"APPS16","comment":"Polaric Server utvikling","path":"TCPIP*,qAC,T2NORWAY"},{"class":"a","name":"LD8MR-B","type":"l","time":"1334415257","lasttime":"1422023150","lat":"66.31617","lng":"14.14750","symbol":"D&","srccall":"LD8MR-B","dstcall":"APDG02","comment":"440 Voice 434.85000MHz -2.0000MHz","path":"TCPIP*,qAC,LD8MR-BS"},{"class":"a","name":"IRLP5919","type":"o","time":"1404551955","lasttime":"1422022923","lat":"66.50917","lng":"13.02150","symbol":"I0","srccall":"LA1PHA-2","dstcall":"APRX28","comment":"434.050MHz C088 TOFF R25k LA1FTA Tonnes","path":"TCPIP*,qAC,T2RADOM"},{"class":"a","name":"ENRA","type":"w","time":"1338295708","lasttime":"1422021814","lat":"66.36667","lng":"14.30000","symbol":"\/_","srccall":"LA4GY-13","dstcall":"WX","comment":"Visibility: greater than 7 mile(s):0","path":"TCPIP*,qAC,T2MEXICO"}]}';
      $arr = json_decode($aprsJSON, true);
 		  $this->response($arr);
    }

    public function aprsElastic_get() {
      $aprsJSON = file_get_contents('http://mortenj.dev.hamlabs.no/api/geo/radius/?lat=66.30&lon=14.10&radius=30&minutes=60');
      $arr = json_decode($aprsJSON, true);
 		  $this->response($arr);
    }
}
