import React, { useState, useEffect } from 'react';
//import '../../../public/assets/css/styles.css';
import DashboardHeader from './DashboardHeader';
// import InvoiceList from './InvoiceList';
// import ContactList from './ContactList';
import CompanyList from './CompanyList';

const Dashboard = ({ user }) => {
  const [invoices, setInvoices] = useState([]);
  const [contacts, setContacts] = useState([]);
  const [companies, setCompanies] = useState([]);

  useEffect(() => {
    // API request imitation
    const fetchInvoices = async () => {
      const response = await fetch('/api/invoices'); // API request
      const data = await response.json();
      setInvoices(data.slice(-5)); // Five last invoices
    };

    const fetchContacts = async () => {
      const response = await fetch('/api/contacts'); // API request
      const data = await response.json();
      setContacts(data.slice(-5)); // Five last contacts
    };

    const fetchCompanies = async () => {
      const response = await fetch('/api/companies'); // API request
      const data = await response.json();
      setCompanies(data.slice(-5)); // Five last companies
    };

    fetchInvoices();
    fetchContacts();
    fetchCompanies();
  }, []);

  return (
    <div className="dashboard">
      <DashboardHeader user={user} />
      <div className="stats">
        <InvoiceList invoices={invoices} />
        <ContactList contacts={contacts} />
        <CompanyList companies={companies} />
      </div>
    </div>
  );
};

export default Dashboard;

