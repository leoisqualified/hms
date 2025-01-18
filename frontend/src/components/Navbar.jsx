import React, { useState } from "react";
import { NavLink, useNavigate } from "react-router-dom";
import { assets } from "../assets/assets/assets";

const Navbar = () => {
  const navigate = useNavigate();
  const [token, setToken] = useState(true);

  return (
    <div className="flex items-center justify-between text-sm py-4 mb-5 border-b border-b-gray-400">
      {/* Logo */}
      <img
        className="w-44 cursor-pointer"
        src={assets.logo}
        alt="Logo"
        onClick={() => navigate("/")}
      />

      {/* Navigation Links */}
      <ul className="hidden md:flex items-start gap-5 font-medium">
        <NavLink
          to="/"
          className={({ isActive }) =>
            isActive ? "text-primary" : "text-gray-800"
          }
        >
          <li className="py-1">HOME</li>
        </NavLink>
        <NavLink
          to="/about"
          className={({ isActive }) =>
            isActive ? "text-primary" : "text-gray-800"
          }
        >
          <li className="py-1">ABOUT</li>
        </NavLink>
        <NavLink
          to="/doctors"
          className={({ isActive }) =>
            isActive ? "text-primary" : "text-gray-800"
          }
        >
          <li className="py-1">ALL DOCTORS</li>
        </NavLink>
        <NavLink
          to="/contact"
          className={({ isActive }) =>
            isActive ? "text-primary" : "text-gray-800"
          }
        >
          <li className="py-1">CONTACT</li>
        </NavLink>
      </ul>

      {/* User Actions */}
      <div className="flex items-center gap-4">
        {token ? (
          <div className="relative group">
            {/* Profile Icon */}
            <div className="flex items-center gap-2 cursor-pointer">
              <img
                className="w-8 h-8 rounded-full"
                src={assets.profile_pic}
                alt="Profile"
              />
              <img
                className="w-2.5"
                src={assets.dropdown_icon}
                alt="Dropdown Icon"
              />
            </div>

            {/* Dropdown Menu */}
            <div className="absolute top-full right-0 mt-2 bg-stone-100 rounded shadow-lg text-gray-600 text-base font-medium hidden group-hover:block">
              <div className="min-w-48 flex flex-col gap-4 p-4">
                <p
                  onClick={() => navigate("/my-profile")}
                  className="hover:text-black cursor-pointer"
                >
                  My Profile
                </p>
                <p
                  onClick={() => navigate("/my-appointments")}
                  className="hover:text-black cursor-pointer"
                >
                  My Appointments
                </p>
                <p
                  onClick={() => {
                    setToken(false); // Logout logic
                  }}
                  className="hover:text-black cursor-pointer"
                >
                  Logout
                </p>
              </div>
            </div>
          </div>
        ) : (
          <button
            className="px-4 py-2 text-sm font-medium rounded-md text-white-800 bg-primary hover:bg-primary-dark"
            onClick={() => navigate("/")}
          >
            Create Account
          </button>
        )}
      </div>
    </div>
  );
};

export default Navbar;
