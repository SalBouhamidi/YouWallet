import { AxiosConsumed } from "../../api/AxiosConsumed";
import { useState } from "react"
import { useNavigate } from "react-router-dom";

 
export function Register(){

    const [name, setName] = useState('')
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const Navigate = useNavigate("");


    const handleName = () =>{
        let name= document.getElementById('name').value
        setName(name);
    }
    const handleEmail =() =>{
        let email = document.getElementById('exampleInputEmail1').value
        setEmail(email);
    }
    const handlePassword=() =>{
        let password = document.getElementById('password').value;
        setPassword(password);
    }
    const handleSubmit=async(event) =>{
        event.preventDefault();


        try {
            const response = await AxiosConsumed.post(
              "/register",
              {            
                name: name,
                email:email,
                password: password
            }
            );
      
            if (response.status === 200) {
              console.log("your account has been registred successfuly!")
              setName("")
              setEmail("")
              setPassword("")
              Navigate("/Transaction");
            } else {
                console.log('try again')
            }
          } catch (error) {
            console.error("Error problem:", error);
          }
        };
    

    


    return(
        <>
        <h3 className="mt-5">Welcome to YouWallet</h3>
        <form>
                <div className="mb-3">
                    <label  className="form-label">Full Name</label>
                    <input type="text" className="username form-control" id="name" onChange={handleName} />
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputEmail1" className="form-label">Email address</label>
                    <input type="email" onChange={handleEmail} className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputPassword1" className="form-label" >Password</label>
                    <input type="password" className="form-control" id="password" onChange={handlePassword}/>
                </div>
                <div className="mb-3">
                    <label htmlFor="exampleInputPassword1" className="form-label">Repeat Password</label>
                    <input type="password" className="form-control"/>
                </div>

            <button type="submit" className="btn btn-submit text-light" onClick={handleSubmit}>Submit</button>
        </form>
        </>
    )
}