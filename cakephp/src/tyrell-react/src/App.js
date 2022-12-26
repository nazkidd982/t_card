import logo from './logo.svg';
import './App.css';
import {useEffect, useState} from "react";

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

    return (<div className="App">
        <header className="App-header">
            <img src={logo} className="App-logo" alt="logo"/>
            <p>
                React has been installed && working.
            </p>
        </header>
        <h4>Card Distribution</h4>
        {data && data.map(function (items, index) {
            return (
                <p><b>Player { index + 1 }: </b>
                    {items.map((subItems, sIndex, array) => {
                        return <span>{subItems} {sIndex !== array.length - 1 ? ', ' : ''} </span>
                    })}
                </p>
            );
        })}
    </div>);
}

export default App;
