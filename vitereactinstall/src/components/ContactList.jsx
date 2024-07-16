import React from 'react';

const ContactList = ({ contacts }) => {
  return (
    <div>
      <h2>Last Contacts</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>e-mail</th>
           </tr>
        </thead>
        <tbody>
          {contacts.map(contact => (
            <tr key={company.id}>
              <td>{contact.name}</td>
              <td>{contact.phone}</td>
              <td>{contact.mail}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default CompanyList;