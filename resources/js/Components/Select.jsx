export default function Select({ placeholder, options, ...props }) {
    return (
        <select
            className='mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'
            {...props}>
            <option value=''>{placeholder ? placeholder : 'Select an option'}</option>
            {options.map((option, index) => (
                <option key={index} value={option.id}>
                    {option.name}
                </option>
            ))}
        </select>
    );
}
