import {BrowserRouter, Routes, Route} from "react-router-dom"
import Layout from "./pages/Layout";
import Transations from "./pages/Transactions";
import { History } from "./pages/History";
import { Login } from "./pages/Login";
import { Register } from "./pages/Register";
export default function App(){

    return (
        <>
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Layout/>} ></Route>
                <Route path="/home" element={<Layout/>} ></Route>

                <Route path="/Transaction" element={<Transations/>} ></Route>
                <Route path="/history" element={<History/>} ></Route>
                <Route path="/login" element={<Login/>} ></Route>
                <Route path="/register" element={<Register/>} ></Route>
            </Routes>
        </BrowserRouter>

        </>
    );
}