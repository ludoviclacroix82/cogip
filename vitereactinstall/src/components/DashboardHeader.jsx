import React from 'react';
import DashboardHeaderImage from '../../../public/assets/img/dashboard_header.png'
//import './DashboardHeader.css'
 
export default function DashboardHeader ({user}) {
    return (
        <div>
            <>
            <h1>Dashboard</h1>
            <div className='DBHeaderContainer'>
                <div className='TextElement'>
                    <h2>Welcome back {user}!</h2>
                    <p>You can here add an invoice, a company
                    and some contacts</p>
                </div>
                <div className='ImageElement'>
                    <img src={dashboardHeaderImage} alt="Dashboard Header" />
                </div>
            </div>
            </>
        </div>
    )
}