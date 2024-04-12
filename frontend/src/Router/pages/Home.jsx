import {Link} from "react-router-dom"

export function Home(){
    return(
        <>
            <Link to="/home" className="text-dark fs-2  ms-5 text-decoration-none fw-bold">Welcome to YouWallet</Link>
            <div className="d-flex justify-content-between w-100">
                <div className="w-50   d-flex d-flex flex-column">
                    <p className="d-flex align-items-center h-50">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi minus cumque 
                        necessitatibus recusandae dolore eligendi magnam, facere consectetur deserunt 
                        nesciunt, dolorem, eius voluptatibus sit vitae ullam pariatur modi. Esse, labore? </p>
                    <div>
                    <Link to="/login" className="text-dark  ms-5  fw-bold">Login </Link>
                    <Link to="/register" className="text-dark   ms-5  fw-bold">Register</Link>
                    </div>
                </div>




                <div className="w-50"><img src={require('../../images/Amico.png')} className="img-fluid" alt="" /></div>
            </div>
        </>
    )
}