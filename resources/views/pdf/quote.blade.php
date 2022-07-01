<!DOCTYPE html>
<html>
<head>
    <meta http-equiv=Content-Type content="text/html;">
    <style>
        @page {
            margin-top: 80px;
        }
        body {
            font-family: "Arial", sans-serif;
            font-size: 11px;
        }

        .page-break-void{
            page-break-inside: avoid;
        }
        .font-weight-bold{
            font-weight: bold;
        }
        .text-right{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .text-left{
            text-align: left;
        }
        .half-width{
            width: 50%;
        }
        .customer-info{
            margin-top: 150px !important;
        }
        .customer-info table{
            margin-top: 100px !important;
        }
        .strong-blue-background{
            background: #22527B;
            color: #ffffff;
            border-bottom: 1px solid #3C91DA;
        }
        .strong-blue-background td{
            color: #ffffff;
        }
        .column-header{
            color: #337AB7;
        }
        .total-border{
            border-top: 1px solid #000000;
            border-bottom: 2px solid #000000;
        }
        .full-width{
            width: 100%;
        }
        table.full-width{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .font-sm{
            font-size: 10px;
        }
        .margin-bottom-sm{
            margin-bottom: 10px;
        }
        .margin-bottom-md{
            margin-bottom: 15px;
        }
        table{
            border-collapse: collapse;
        }
        .pre-wrap{
            white-space: pre-wrap;
        }
        .light-blue-background{
            background: #337AB7;
            color: #ffffff;
        }
        .light-blue-background td{
            color: #ffffff;
            text-align: center;
        }
        .annual-quote-table:not(:first-child){
            margin-top: 100px;
        }
        .visible-hidden{
            visibility: hidden;
        }
        @page page-landscape{size: landscape}
        @page page-portrait {size: portrait}
        .table-of-content{
            page: page-portrait;
            page-break-after: avoid;
        }
    </style>

</head>

<body lang=EN-US>
<div class="customer-info">
    <table class="full-width">
        <tr>
            <td class="half-width"> <div>COMPANY</div></td>
            <td class="text-right font-weight-bold"> <div>Date:</div></td>
            <td class="text-left">{{date('M d, Y')}}</td>
        </tr>
        <tr>
            <td class="half-width"> <div>ADDRESS</div></td>
            <td class="text-right font-weight-bold"> <div>Prepared By:</div></td>
            <td class="text-left">{{$data['current-user']}}</td>
        </tr>
        <tr>
            <td class="half-width"> <div>CITY</div></td>
            <td class="text-right font-weight-bold"> <div>Prepared By:</div></td>
            <td class="text-left">{{$data['user-phone-number']}}</td>
        </tr>
        <tr>
            <td class="half-width"></td>
            <td class="text-right font-weight-bold"> <div></div></td>
            <td class="text-left">{{$data['email']}}</td>
        </tr>
        <tr>
            <td class="half-width">WEBSITE</td>
            <td class="text-right font-weight-bold"> <div></div></td>
            <td class="text-left">{{$data['office']}}</td>
        </tr>
    </table>
</div>
<div class="quote-section">
    <div>
        <tocentry content="Quote For Services" />
        <h1 class="text-center margin-bottom-sm">Chapter 1</h1>
    </div>
</div>
<pagebreak/>
<div class="dynamic-section">
    <div class="predefined-section">
        <tocentry content="{{$section->name}}" />
        <div class="text-center">
            <h1 class="margin-bottom-md visible-hidden">{{$section->name}}</h1>
        </div>
        <div class="template-content">
            {!! $section->template !!}
        </div>
    </div>
</div>
<div class="table-of-content">
    <tocpagebreak toc-orientation="P" links="ON" toc-prehtml="&lt;h1 class=&quot;text-center&quot;&gt;Table of Contents&lt;/h1&gt;"/>
</div>
</body>
</html>
