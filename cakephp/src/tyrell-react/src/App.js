import logo from './logo.svg';
import './App.css';
import React, {useEffect, useState} from "react";

function App({url}) {
    const [data, setData] = useState([]);
    useEffect(() => {
        const controller = new AbortController();
        const signal = controller.signal;
        fetch(url, {
            signal, headers: {
                'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json', 'Accept': 'application/json',
            }
        }).then(response => response.json()).then((data) => setData(data.data));

        return () => controller.abort();
    }, [url]);

    const [playerNumber, setPlayerNumber] = useState("")

    interface FormDataType {
        playerNumber: number
    }

    const responseBody: FormDataType = {playerNumber: ""}

    const onSubmitHandler = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        responseBody.playerNumber = playerNumber
        fetch('/react/api', {
            method: 'POST',
            body: JSON.stringify(responseBody),
            headers: {
                'Content-Type': 'application/json'
            },
        }).then(response => response.json()).then(function(data) {
            console.log(data)
            setData(data.data)
        })
    }
    const inputChangeHandler = (setFunction: React.Dispatch<React.SetStateAction<string>>, event: React.ChangeEvent<HTMLInputElement>) => {
        setFunction(event.target.value)
    }

    return (<div className="App">
        <header className="App-header">
            <img src={logo} className="App-logo" alt="logo"/>
            <p>
                React has been installed && working.
            </p>
        </header>
        <h4>Card Distribution</h4>
        <form onSubmit={onSubmitHandler}>
            <div><label htmlFor="player_number">Number of Players</label></div>
            <div><input id="player_number" onChange={(e) => inputChangeHandler(setPlayerNumber, e)}
                        type="number" /></div>
            <input type="submit"/>
        </form>
        {data && data.map(function (items, index) {
            return (<p>
                    {items.map((subItems, sIndex, array) => {
                        return <span>{subItems}{sIndex !== array.length - 1 ? ', ' : ''} </span>
                    })}
                </p>);
        })}
    </div>);
}

export default App;
