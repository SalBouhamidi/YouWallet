import { AxiosConsumed } from "../../api/AxiosConsumed"
import { useState } from "react"
import { useNavigate } from "react-router-dom"

export function Login(){

    const [email, setEmail]= useState('')
    const[password, setPassword] =useState('')
    const Navigate = useNavigate("");

    const handleEmail = () =>{
        let email = document.getElementById("email").value
        setEmail(email)
    }

    const handlePassword = () =>{
        let password = document.getElementById("password").value
        setPassword(password)
    }

    const handleSubmit = async(event) =>{
        event.preventDefault();
        const data = {
            email:email,
            password:password
        }
        console.log(data)
        
        try{
            const response  = await AxiosConsumed.post(
                "/login",
                {
                    email:email,
                    password:password
                }
            )
            console.log({
                email:email,
                password:password
            })
            if(response.status === 200){
                console.log('welcome to your account')
                setEmail("")
                setPassword("")
                Navigate("/Transaction");
            }else{
                console.log('try again')
            }
        }catch(error){
            console.error("Error problem:", error)
        }

    }




    return(
        <>
       <h3 className="mt-5">Welcome to YouWallet</h3>
        <form>
                <div className="mb-3">
                    <label htmlFor="exampleInputEmail1" className="form-label" >Email address</label>
                    <input type="email" className="form-control" id="email" onChange={handleEmail} aria-describedby="emailHelp"/>
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputPassword1" className="form-label" >Password</label>
                    <input type="password" className="form-control" id="password" onChange={handlePassword}/>
                </div>
         
            <button type="submit" className="btn btn-submit text-light" onClick={handleSubmit}>Submit</button>
        </form>
        </>
    )
}