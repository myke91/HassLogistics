<!DOCTYPE html>
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
                <img src="{{ public_path() . "app\hass-bg.jpg" }}" height="100px" width="100px"/>
            </td>

            <td>
                <p>Invoice No: HLG/TEM/0000106 {{$data['invoiceNumber']}} </p>
                <p>Date: 30/10/17</p>
                <p>Customer ID:</p>
            </td>
        </tr>
    </table>

    <br />
    <table border="1" width="100%">
        <tr>
            <td>Vessel: ESL AUSTRALIA</td>
            <td>ETA: 29 Oct 2017</td>
            <td>Port of Loading: Buchanan</td>
        </tr>

        <tr>
            <td>Voyage: 01</td>
            <td>ETS: 30 Oct 2017</td>
            <td>Port of Discharge: Tema</td>
        </tr>
    </table>

    <p border="1">BL NO: BUCGHA001</p>

    <table border="1" width="100%">
        <tr>
            <td>Item No.</td> <td>Description</td> <td>Basis</td> <td>Per</td> <td>Rate</td> <td>Curr.</td> <td>Amount GHC</td>
        </tr>

        <tr>
            <td>1.</td> <td>Admin Fees</td> <td></td> <td>Unit</td> <td></td> <td>GHC.</td> <td>1000</td>
        </tr>
        <tr>
            <td>2.</td> <td>Dozer</td> <td></td> <td>Unit</td> <td></td> <td>GHC.</td> <td>2300</td>
        </tr>
        <!-- invoice footer -->
        <tr>
            <td colspan="6" style="text-align:right">SUBTOTAL</td> <td>2300</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">VAT/NHIL</td>  <td>2300</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">TOTAL</td> <td>2300</td>
        </tr>
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