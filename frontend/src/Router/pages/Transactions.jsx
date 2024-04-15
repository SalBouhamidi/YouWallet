import { useState } from "react"
import { useNavigate, Link} from "react-router-dom"
import { AxiosConsumed } from "../../api/AxiosConsumed"



export default function Transations(){

    const [montant, setMontant] = useState('')
    const [motif, setMotif]= useState('')
    const [receiver_id, setReceiver_id]=useState('')
    const Navigate= useNavigate("")

    const handleMontant = () =>{
        let montant = document.getElementById('montant').value
        setMontant(montant)
    }

    const handleMotif = () =>{
        const motif = document.getElementById('motif').value
        setMotif(motif)
    }

    const handleReciever = () =>{
        const receiver_id = document.getElementById('receiver_id').value
        setReceiver_id(receiver_id)
    }
    const handleSubmit = async(e) => {
         e.preventDefault()


         const data = {
            montant:montant,
            motif:motif,
            receiver_id:receiver_id
        }
        console.log(data)
         try{
            const token= localStorage.getItem('token');
            if(!token){
                Navigate('/login')    
                
            }else{
                console.log(token)
                const response = await AxiosConsumed.post(
                    "/transactions",
                    {
                        montant:montant,
                        motif:motif,
                        receiver_id:receiver_id
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    }
    
                )
                if(response.status === 200){
                       console.log('your transsactions was made successfully')
                       setMontant("")
                       setMotif('')
                       setReceiver_id('')
                       Navigate("/Transaction");

                }else{
                    console.log('try again please')
                }

            }


         }catch(error){
            console.error("Error". error)
         }
    }


    return (
        <>
 <h3 className="mt-5">Welcome to YouWallet Transaction</h3>
    <h4>Your Balance</h4>

    <div className="card mb-5" >
        <div className="card-body">
            <h5 className="card-title text-light">Your balance info:</h5>
            <h6 className="card-subtitle mb-2 text-body-secondary">Dear User:</h6>
            <p className="card-text text-light">Your sold is: </p>
            <Link to="/history" class="card-link text-body-secondary">See history of user Transaction</Link>
        </div>
    </div>
        <p className="fw-bold">Sending Money</p>
        <form>
                <div className="mb-3">
                    <label  className="form-label">Montant</label>
                    <input type="float" className="form-control" onChange={handleMontant} id="montant" />
                </div>
                <div className="mb-3">
                    <label className="form-label">Motif</label>
                    <input type="text" className="form-control" onChange={handleMotif} id="motif"/>
                </div>
                <div className="mb-3">
                    <label className="form-label">Reciever account's number</label>
                    <input type="number" className="form-control" onChange={handleReciever} id="receiver_id"/>
                </div>
         

            <button type="submit" className="btn btn-submit text-light" onClick={handleSubmit}>Submit</button>
        </form>        
        </>
    )
}
