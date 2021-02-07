<html>
    <head>
        <title></title>
    </head>
    <body style=" width: 100%;">
        <div style="width: 900px; margin: 0 auto;">
            <h1>To whom It May Concern</h1>
            <p>
                This is to certify that <strong>{{$salary->employee->full_name}}</strong> {{$salary->employee->designations->designation}} has drawn
                Pay and Allowances are as follows for the month of {{date('M Y')}}.
            </p>
            <h3>His Salary particulars are given below.</h3>
            <table width="100%">
                <tr>
                    <td colspan="2"><strong>Earn</strong></td>
                </tr>
                <tr>
                    <td>Basic</td>
                    <td>{{$salary->basic_salary}}</td>
                </tr>
                <tr>
                    <td>House Rent</td>
                    <td>{{$salary->house_rent}}</td>
                </tr>
                <tr>
                    <td>Conveyance Allowance</td>
                    <td>{{$salary->conveyance_allowance}}</td>
                </tr>
                <tr>
                    <td>Medical Allowance</td>
                    <td>{{$salary->medical_allowance}}</td>
                </tr>
                <tr>
                    <td>Other Allowance</td>
                    <td>{{$salary->other_allowance}}</td>
                </tr>
                <tr>
                    <td>Gross Salary</td>
                    <td>{{$salary->gross_salary}}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Deduction</strong></td>
                </tr>
                <tr>
                    <td>PF</td>
                    <td>{{$salary->d_pf}}</td>
                </tr>
                <tr>
                    <td>Insurance</td>
                    <td>{{$salary->d_insurance}}</td>
                </tr>
                <tr>
                    <td>Loan</td>
                    <td>{{$salary->d_loan}}</td>
                </tr>
                <tr>
                    <td>House_rent</td>
                    <td>{{$salary->d_house_rent}}</td>
                </tr>
                <tr>
                    <td>Utility</td>
                    <td>{{$salary->d_utility}}</td>
                </tr>
                <tr>
                    <td>Others</td>
                    <td>{{$salary->d_others}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{$salary->d_total_deduction}}</td>
                </tr>
                <tr>
                    <td>Net Salary</td>
                    <td>{{$salary->net_salary}}</td>
                </tr>
            </table>
        </div>
    </body>
</html>
