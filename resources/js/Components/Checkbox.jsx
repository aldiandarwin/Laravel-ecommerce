export default function Checkbox({ className = '', ...props }) {
    return (
        <input
            {...props}
            type='checkbox'
            className={'rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 ' + className}
        />
    );
}
