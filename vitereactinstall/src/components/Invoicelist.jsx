import React from 'react';

const InvoiceList = ({ invoices }) => {
    return (
        <div>
          <h2>Last Invoices</h2>
          <table>
            <thead>
              <tr>
                <th>Invoice Number</th>
                <th>Dates</th>
                <th>Company</th>
               </tr>
            </thead>
            <tbody>
              {invoices.map(invoice => (
                <tr key={invoice.id}>
                  <td>{invoice.number}</td>
                  <td>{invoice.date}</td>
                  <td>{invoice.company}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      );
};

export default InvoiceList;