<style>
@page{
    margin: 2cm;
    }

    /* body {
    font-family: sans-serif;
    margin: 0.5cm 0;
    text-align: justify;
    } */

    #header,
    #footer {
    position: fixed;
    left: 0;
    right: 0;
    color: #aaa;
    font-size: 0.9em;
    }

    #header {
    top: 5;
    border-bottom: 0.1pt solid #aaa;
    }

    #footer {
    bottom: 0;
    border-top: 0.1pt solid #aaa;
    }

    #header table,
    #footer table {
    width: 100%;
    border-collapse: collapse;
    border: none;
    }

    #header td,
    #footer td {
    padding: 0;
    width: 50%;
    }

    .page-number {
    text-align: center;
    }

    .page-number:before {
    content: "Page " counter(page);
    }

    hr {
    page-break-after: always;
    border: 0;
    }

    </style>
    
<div id="header">
  <table><tr><td>Example document</td><td style="text-align: right;">Author</td></tr></table>
</div>