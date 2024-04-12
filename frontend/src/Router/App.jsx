import {BrowserRouter, Routes, Route} from "react-router-dom"
import Layout from "./pages/Layout";
import Transations from "./pages/Transactions";
import { History } from "./pages/History";
import { Login } from "./pages/Login";
import { Register } from "./pages/Register";
import { Home } from "./pages/Home";
export default function App(){

    return (
        <>
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Layout/>} >
                <Route path="/home" element={<Home/>} />
                <Route path="/Transaction" element={<Transations/>} />
                <Route path="/history" element={<History/>} />
                <Route path="/login" element={<Login/>} />
                <Route path="/register" element={<Register/>} />
                </Route>
            </Routes>
        </BrowserRouter>

        </>
    );
}