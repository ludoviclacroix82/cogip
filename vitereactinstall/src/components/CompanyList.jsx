import React from 'react';

const CompanyList = ({ companies }) => {
  return (
    <div>
      <h2>Last Companies</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>TVA</th>
            <th>Country</th>
           </tr>
        </thead>
        <tbody>
          {companies.map(company => (
            <tr key={company.id}>
              <td>{company.name}</td>
              <td>{company.tva}</td>
              <td>{company.country}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default CompanyList;
