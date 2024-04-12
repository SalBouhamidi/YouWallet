import {Link} from "react-router-dom"
export default function Layout(){
    return (
        <>
        <nav>
        <ul className="nav justify-content-between h-25 px-5 py-3">
            <li className="nav-item">
                <Link to="/" className="text-light text-decoration-none fw-bold">Home</Link>
            </li>
            <li className="nav-item">
                <Link to="/Transaction" className="text-light text-decoration-none fw-bold">Made a transaction</Link>
            </li>
            <li className="nav-item">
            <Link to="/history" className="text-light text-decoration-none fw-bold">My history</Link>
            </li>
            <li className="nav-item">
            <Link to="/login" className="text-light text-decoration-none fw-bold">Login</Link>
            </li>
            <li className="nav-item">
            <Link to="/register" className="text-light text-decoration-none fw-bold">Register</Link>
            </li>
        </ul>
        </nav>
        </>
    )
}