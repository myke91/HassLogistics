<!Doctype html>
<html>
    <table border="1" width="100%">
        <tr>
            <td>														
                <p>Meridian Roundabout, Main Harbour</p>							
                <p>Community 1, Tema</p>								
                <p>233 303 220 181-2</p>								
                <p>operations@hasslogistics.com</p>								
                <p>info@hasslogistics.com</p>	
            </td>							
            <td>
                <img src="{{ public_path() . "img\hass-bg.jpg" }}" height="100px" width="100px"/>
            </td>

            <td>
                <p>Invoice No: {{$data[0]->invoice_no}} </p>
                <p>Date: {{date('d-M-Y')}}</p>
                <p>Customer:{{$data[0]->client_name}}</p>
            </td>
        </tr>
    </table>

    <br />
    <table border="1" width="100%">
        <tr>
            <td>Vessel: {{$data[0]->vessel_name}}</td>
            <td>ETA: {{$data[0]->arrival_date}}</td>
            <td>Port of Loading: {{$data[0]->homeport}}</td>
        </tr>

        <tr>
            <td>Voyage: 01</td>
            <td>ETS: 30 Oct 2017</td>
            <td>Port of Discharge: Tema</td>
        </tr>
    </table>

    <p border="1">BL NO: BUCGHA001</p>
    {!! $total = 0 !!}
    <table border="1" width="100%">
        <tbody>
            <tr>
                <td>Item No.</td> <td>Description</td> <td>Billable</td> <td>Quantity</td> <td>Unit Price</td> <td>Amount GHC</td>
            </tr>
            @foreach($data as $key => $value)
            <tr>
                <td>Item No.</td> <td>{{$value->bill_item}}</td> <td>{{$value->billable}}</td> <td>{{$value->quantity}}</td> <td>{{$value->unit_price}}</td> <td>{{$value->actual_cost}}</td>
            </tr>
            {!! $total+=$value->actual_cost !!}
            @endforeach


        </tbody>
        <!-- invoice footer -->
        <tfoot>
            <tr>
                <td colspan="5" style="text-align:right">SUBTOTAL</td> <td>0</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:right">VAT/NHIL</td>  <td>0</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:right">TOTAL</td> <td>{{$total}}</td>
            </tr>
        </tfoot>
    </table>
    <br />
    <div style="border-style: solid; border-width: 1px">
        <p>BANK DETAILS</p>
        <p>BANK: PRUDENTIAL BANK LIMITED</p>
        <p>COMMUNITY 1 BRANCH, TEMA</p>
        <p>ACCOUNT NAME: HASS LOGISTICS GHANA LIMITED</p>
        <p>ACCOUNT NO-GHS: 0122001600013</p>
    </div>
</html>