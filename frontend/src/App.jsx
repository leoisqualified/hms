import React from "react";
import { Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import Login from "./pages/Login";
// import { Register } from "./pages/Register";
// import { Dashboard } from "./pages/Dashboard";
import MyProfile from "./pages/MyProfile";
import MyAppointments from "./pages/MyAppointments";
import Doctors from "./pages/Doctors";
import Contact from "./pages/Contact";
import Appointment from "./pages/Appointment";
import Navbar from "./components/Navbar";

// App.jsx
const App = () => {
  return (
    <div className="mx-4 sm:mx-[10%]">
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        {/* <Route path="/register" element={<Register />} /> */}
        {/* <Route path="/dashboard" element={<Dashboard />} /> */}
        <Route path="/my-profile" element={<MyProfile />} />
        <Route path="/my-appointments" element={<MyAppointments />} />
        <Route path="/doctors" element={<Doctors />} />
        <Route path="/doctors/:speciality" element={<Doctors />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/appointment/:docId" element={<Appointment />} />
      </Routes>
    </div>
  );
};

export default App;
